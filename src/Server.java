import java.io.*;
import java.net.*;
import java.sql.*;
import java.sql.Date;
import java.time.format.DateTimeFormatter;
import java.time.LocalDateTime;
import java.util.*;






public class Server {

   private static int receiptNum =-90;  //receipt Number to be checked 
   private static final int NO_BALANCE_EXISTS = -1; // var to be used once the receipt number already exists in the database



    public static void main(String[] args) {
        ServerSocket serverSoc =null;
        Socket ss = null;
        Scanner fromclient = null;
        PrintWriter pr = null;
        String message = null;
        String userInput =null;
        String[] command  = null;
        String SecureMenu = null;
        int PhoneNumber =0;
        String MemberNumber = null;
        String loggedInUsername = null;
        String loggedInPassword = null;
        Scanner sc = null;
       // Scanner hj=null;
        
        

        //db connect
        try {
            JDBC.getInstance().connect();
            //
        } catch (Exception e) {
           
            System.out.println(e.getMessage());
        } 
      



        try {
            serverSoc = new ServerSocket(5656);
            System.out.println("Server running ...");
            ss = serverSoc.accept();
            System.out.println("         New Client connection        ");
            pr = new PrintWriter(ss.getOutputStream(),true);
            
            fromclient = new Scanner(ss.getInputStream());
            
            
             
            message ="Welcome to Uprise Sacco program please login";
            pr.println(message);

            
            //secure menu to send to the client 
            SecureMenu = "1. Deposit amount datedeposited receiptNumber\n" +
             "2. CheckStatement dateFrom dateTo\n" +
             "3. requestLoan amount paymentPeriodinMonths\n" +
             "4. LoanRequestStatus LoanApplicationNumber";

             
            while ((userInput = fromclient.nextLine()) != null) {
                command = userInput.split(" ");
                if (command.length > 1 && command.length <= 5) {
                    System.out.println(userInput);
                    switch (command[0]) {
                        case "login":
                            if (isValidCredentials(command[1], command[2])) {
                                loggedInUsername = command[1];
                                loggedInPassword = command[2];
                                pr.println("You have successfully logged in. Here is the secured menu:");

                                String[] menuOptions = SecureMenu.split("\n");
                                for (String option : menuOptions) {
                                    pr.println(option);
                                }
                                pr.println("END_MENU");

                                // Loop to handle user commands within the logged-in session
                                while (true) {
                                    userInput = fromclient.nextLine();
                                    System.out.println(userInput);
                                    command = userInput.split(" ");
                                    
                                    
                                    switch (command[0]) {
                                        case "logout":
                                            //pr.println("You have been logged out. Thank you for using our service.");
                                            System.out.println("user logged out of the system!");
                                            //return; // Exit the loop and terminate the session
                                        case "deposit":
                                            if (command.length == 4) {
                                                int output = deposit(loggedInUsername, command[1], command[2],
                                                        command[3]);

                                                double inputAmount = Double.parseDouble(command[1]);
                                                int receiptNumber = Integer.parseInt(command[3]);

                                                if (output == 0) {
                                                    
                                                    updateBalance(receiptNumber, inputAmount);
                                                    markReceiptAsUsed(receiptNumber);

                                                    pr.println("Dear MR/MRS " +loggedInUsername+ " your deposit of amount :" +inputAmount+" has been successfully made. New balance: UGX "+getFinalBalance(loggedInUsername) );
                                                            
                                                } else if (output == 1) {
                                                    pr.println("Deposit has already been made with receipt number: "+receiptNumber);
                                                            
                                                } else {
                                                    pr.println("Deposit failed. Receipt number " +receiptNumber +" does not exist. Please try again after 24 HRS.");
                                                            
                                                }
                                            } else {
                                                pr.println(
                                                        "Invalid deposit command format. Please provide all the required parameters.");
                                            }
                                            break;

                                        case "requestLoan":
                                            // Handle requestLoan command
                                            if (command.length == 3) {
                                                int amountrest =Integer.parseInt(command[1]);
                                                int months = Integer.parseInt(command[2]);
                                               
                                                String LoanResult = LoanRequest(loggedInUsername,amountrest, months);

                                                if (LoanResult.startsWith("L")) {
                                                    pr.println("Dear MR/MRS "+loggedInUsername+" your loan request of ugx "+amountrest+" to be paid in "+months+" month/s has been received for processing Your loan application number is : "+LoanResult);
                                                    System.out.println("Loan request made and assigned the loan Application Number : "+LoanResult);

                                                }else{
                                                    pr.println("LoanResult failed");
                                                }

                                                
                                            }else {
                                                pr.println("Invalid Loan request command format. Please provide all the required parameters.");
                                            }
                                            
                                            
                                            
                                            break;
                                        case "LoanRequestStatus":
                                            // Handle checkLoanStatus command

                                            if (command.length==2) {
                                               String applicationNumber = (command[1]);
                                               String status = CheckStatusOfLoanAppNumber(applicationNumber);
                                               String gotten = validateLaonApplicationNumberofCheckStatus(applicationNumber);
                                               double LoanApproved = LoanFromSystem(applicationNumber);

                                               
                                                if ((gotten.equals("Not gotten"))||(gotten.equals("Not found")) && (status.equals("No status"))) {

                                                    pr.println("Oops ! currently there's no loan application for the above number");

                                                

                                                }else if ((gotten.startsWith("LAN")) && status.equals("Pending")) {
                                                    pr.println("Dear our customer your loan for the loan application number : "+applicationNumber +" is still pending");
                                                    System.out.println("Checked status of a pending loan ");


                                                } else  if  ((gotten.startsWith("LAN")) && status.equals("Processing")) {

                                                    pr.println("Dear customer your loan request of application number : "+applicationNumber+" is still under processing");
                                                    System.out.println("Checked status of  loan under processing");
                                                        
                                                }
                                                
                                                // }
                                                else {
                                                    pr.println("Dear customer your loan request of application number : "+applicationNumber+" has been activated and the suggested amount is : "+LoanApproved);
                                                    pr.print("Confirm loan:");



                                                    System.out.println("Checked status of active loan ");
                                                }
                                                    
                                            
                                                      
                                                    
                                            }else{
                                                    pr.println("Please provide all fields for the LoanRequestStatus ");
                                                }


                                            break;
                                        case "CheckStatement":

                                            // Handle CheckStatement command        //@@@@@@@@@@

                                            break;

                                        case "yes":

                                            pr.println("Dear MR/Mrs "+loggedInUsername+" your loan has been succesfully approoved. ");

                                            break;

                                        case "no":

                                            pr.println("Dear MR/Mrs "+loggedInUsername+" your loan has been succesfully approoved. ");

                                            break;
                                        default:
                                            pr.println("Please follow the menu to acces the services.");
                                           
                                    }
                                   
                                }

                            } else {
                                pr.println(
                                        "Authentication failed. Invalid credentials. If you have forgotten your password, use: forgotPassword <membernumber> <phonenumber>");
                            }
                            break;
                        case "forgotPassword":
                            // Handle forgotPassword command
                            if (validateMemberInformation(command[1], command[2]).equals("One match")) {
                                pr.println(
                                        "Please return after a day while your issue has been resolved. Your reference number is: "
                                                + ReferenceNumber(MemberNumber,PhoneNumber));
                            } else if (validateMemberInformation(command[1], command[2]) == null) {
                                break;
                            } else {
                                pr.println(validateMemberInformation(command[1], command[2]));
                            }
                            break;
                        default:
                            pr.println("Unknown command");
                            break;
                    }
                } else {
                    pr.println("Please log into the system to access the secured menu.");
                }
            }

                    
               
            
            
        }catch (Exception  e) {
            if (userInput.equalsIgnoreCase("logout")) {
                System.out.println("user logged out of system");
               
            }

            System.out.println("Error !"+e.getMessage());
            pr.println("Internal Server run down please try again later!");
        }


                
    }


    //deposit method to call
    private static int deposit(String username, String amount, String datedeposited, String receiptNumber) {
        try {
            int receiptNum = Integer.parseInt(receiptNumber);

            JDBC jdbcInstance = JDBC.getInstance();
            Connection connection = jdbcInstance.getConnection();

            String sql = "SELECT used FROM sacco_deposits WHERE Username = ? AND amount = ? AND dateDeposited = ? AND receiptNumber = ?";
            PreparedStatement selection = connection.prepareStatement(sql);
            selection.setString(1, username);
            selection.setDouble(2, Double.parseDouble(amount));
            selection.setDate(3, Date.valueOf(datedeposited));
            selection.setInt(4, receiptNum);

            ResultSet result = selection.executeQuery();

            if (result.next()) {
                int usedStatus = result.getInt("used");
                return usedStatus; // This will be 0 (false) or 1 (true)
            }

        } catch (Exception e) {
            System.out.println("Exception: " + e.getMessage());
        }
        return -1;
    }
    

    
    //method that validates the login command
    private static boolean isValidCredentials(String username, String password) {
        
        try {
           

            JDBC jdbcInstance = JDBC.getInstance();
            Connection connection = jdbcInstance.getConnection();
   
            

            String sql = "SELECT * FROM sacco_members WHERE Username = ? AND password = ?";
            PreparedStatement statement = connection.prepareStatement(sql);
            statement.setString(1, username);
            statement.setString(2, password);

            ResultSet resultSet = statement.executeQuery();

            boolean isValid = resultSet.next();

            

            return isValid;
        } catch (SQLException e) {
           
           System.out.println(e.getMessage());
            
        }return false;
    }
  
    //method to generate the reference number
    private static int ReferenceNumber(String MemberNumber, int phoneNumber) {
       
        String DateofRequest = LocalDateTime.now().format(DateTimeFormatter.ofPattern("yyy-MM-dd HH:mm:ss"));
        int referenceNumber = 0; // Initialize the referenceNumber variable to store the generated value.
    
        try {
            

            JDBC jdbcInstance = JDBC.getInstance();
            Connection connection = jdbcInstance.getConnection();
    
            // Use prepared statement with placeholders to insert the values
            String insertSql = "INSERT INTO sacco_issues (MemberNumber, phoneNumber, DateofRequest) VALUES (?, ?, ?)";
            PreparedStatement insertStatement = connection.prepareStatement(insertSql, Statement.RETURN_GENERATED_KEYS);
            insertStatement.setString(1, MemberNumber);
            insertStatement.setInt(2, phoneNumber);
            insertStatement.setString(3, DateofRequest);
            insertStatement.executeUpdate();
    
            // Retrieve the generated ReferenceNumber
            ResultSet generatedKeys = insertStatement.getGeneratedKeys();
            if (generatedKeys.next()) {
                referenceNumber = generatedKeys.getInt(1); // Since the ReferenceNumber is an INT column.
                return referenceNumber;
            }
    
            // Close resources
            generatedKeys.close();
            insertStatement.close();
            connection.close();
    
        } catch (SQLException e) {
            System.out.println("Error: " + e.getMessage());
        }
    
        return 0;
    }
  

    //to be used to retrive the password 
    private static String validateMemberInformation(String MemberNumber, String phonenumber) {
        String user_password = null;
       

        try {

            JDBC jdbcInstance = JDBC.getInstance();
            Connection connection = jdbcInstance.getConnection();
            int phoneNumberInt = Integer.parseInt(phonenumber); // Convert the input phonenumber to an integer

            // Use a PreparedStatement to create a parameterized query
            String query = "SELECT * FROM sacco_members WHERE MemberNumber = ? OR phoneNumber = ?";
            PreparedStatement statement = connection.prepareStatement(query);

            // Set the parameters for the query
            statement.setString(1, MemberNumber);
            statement.setInt(2, phoneNumberInt); // Use setInt to set the phoneNumber parameter

            ResultSet result = statement.executeQuery();

            boolean memberFound = false;
            boolean phoneNumberFound = false;

            while (result.next()) {
                String foundMemberNumber = result.getString("MemberNumber");
                int foundPhoneNumber = result.getInt("phoneNumber"); // Get the phoneNumber as an integer from the
                                                                    

                if (MemberNumber.equals(foundMemberNumber)) {
                    memberFound = true;
                    user_password = result.getString("password");
                }

                if (phoneNumberInt == foundPhoneNumber) {
                    phoneNumberFound = true;
                    user_password = result.getString("password");
                }
            }

            if (memberFound && phoneNumberFound) {
                return user_password; // Both match
            } else if (memberFound || phoneNumberFound) {
                //to insert the phone number and the MemberNumber into the issues table for the admin to find out the issue 
                ReferenceNumber(MemberNumber, phoneNumberInt);
                return "One match"; // One of them matches
            } else {
                return "No record found. Return after a day"; // None match
            }
        } catch (NumberFormatException e) {
            System.out.println("Error: Invalid phoneNumber format.");
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }

        return "Error: An unexpected error occurred.";
    }

 
    //returns oldaccountbalance
    private static int getOldAccountBalance(int receiptNumber)  {
       
       
        try{


            JDBC jdbcInstance = JDBC.getInstance();
            Connection connection = jdbcInstance.getConnection();

            String query = "SELECT accountBalance FROM sacco_members u  INNER JOIN sacco_deposits d ON u.Username = d.Username  WHERE d.receiptNumber = ?";

            PreparedStatement statement = connection.prepareStatement(query);
            statement.setInt(1, receiptNumber);

            ResultSet resultSet = statement.executeQuery();
                if (resultSet.next()) {
                   int  balance = resultSet.getInt("accountBalance");
                    return balance;
                   
                }
            
        }catch(Exception e){
            System.out.println("Error: " +e.getMessage());
        }

        return -1;
    }


    ////method to update the balance in the members table     
    private static void updateBalance(int receiptNumber,double inamount) {
        try {

            
            int oldbalance = getOldAccountBalance(receiptNumber);

            if (oldbalance == -1) {

                return;
                
            }


            //update the balance with the deposited amount 
            double newBalance = (double)oldbalance + inamount;

            String updateQuery = "UPDATE sacco_members s JOIN sacco_deposits d ON s.Username = d.Username SET s.accountBalance = ? WHERE d.receiptNumber = ?";

            
                JDBC jdbcInstance = JDBC.getInstance();
                Connection connection = jdbcInstance.getConnection();
                PreparedStatement statement = connection.prepareStatement(updateQuery) ;
                statement.setDouble(1, newBalance);
                statement.setInt(2, receiptNumber);
                statement.executeUpdate();
            

            // Log the successful deposit and return true
            System.out.println("balance updated successfuly");
           // return "yay";
        } catch (SQLException e) {
            System.out.println("Error: "+e.getMessage());
            // If there's an error, log the failure and return false
            System.out.println("Balance not updated");
           // return "oops!";
        }
    }



    //method to get the final balance after update using  the username
    private static int getFinalBalance(String username)  {
        
        int balance =  0;

        try{

            JDBC jdbcInstance = JDBC.getInstance();
            Connection connection = jdbcInstance.getConnection();
            String query = "SELECT accountBalance FROM sacco_members where username = ?";
            PreparedStatement statement = connection.prepareStatement(query);
             
            statement.setString(1, username);

            ResultSet resultSet = statement.executeQuery();
                
                if (resultSet.next()) {

                    balance = resultSet.getInt("accountBalance");
                    return balance;

                }
                
            
        }catch(Exception e){
            System.out.println("Error: " +e.getMessage());
        }

        return 0;
    }



    //method to get final balance using the username in an inner join
    private static int getFinalBalancew(String LoanAppNo)  {
        
        int balance =  0;

        try{

            JDBC jdbcInstance = JDBC.getInstance();
            Connection connection = jdbcInstance.getConnection();
            String query = "SELECT accountBalance  FROM sacco_members u inner join sacco_loan_requests L on u.Username = L.username  where L.LoanAppNumber = ?";
            PreparedStatement statement = connection.prepareStatement(query);
             
            statement.setString(1, LoanAppNo);

            ResultSet resultSet = statement.executeQuery();
                
                if (resultSet.next()) {

                    balance = resultSet.getInt("accountBalance");
                    return balance;

                }
                
            
        }catch(Exception e){
            System.out.println("Error: " +e.getMessage());
        }

        return 0;
    }


    //method to request for a loan and also return a loanApplication Number
    private static String LoanRequest(String username,int amountrequesting, int pymentperiod){
        String generatedLoanApplicationNumber =null;
        
        
        
        try {
            JDBC jdbcInstance = JDBC.getInstance();
            Connection connection = jdbcInstance.getConnection();
            String querry = "insert into sacco_loan_requests (username, amountrequesting, paymentperiod) values (?,?,?)";
            PreparedStatement insertStatement = connection.prepareStatement(querry);
            insertStatement.setString(1, username);
            insertStatement.setInt(2, amountrequesting);
            insertStatement.setInt(3, pymentperiod);
            

            

            int rowsAffected = insertStatement.executeUpdate();

            //fetching the generated loan application number
            if (rowsAffected > 0) {
                String fetchQuery = "SELECT LoanAppNumber FROM sacco_loan_requests WHERE username = ? AND amountrequesting = ? AND paymentperiod = ?";
                PreparedStatement fetchStatement = connection.prepareStatement(fetchQuery);
                fetchStatement.setString(1, username);
                fetchStatement.setInt(2, amountrequesting);
                fetchStatement.setInt(3, pymentperiod);

                ResultSet resultSet = fetchStatement.executeQuery();
                if (resultSet.next()) {
                    generatedLoanApplicationNumber = resultSet.getString("LoanAppNumber");
                }else{
                    return "not found";
                }
                fetchStatement.close();
            }

            //System.out.println(generatedLoanApplicationNumber);
           
            return generatedLoanApplicationNumber;
           
            
        } catch (Exception e) {
            System.out.println("Denied :"+e.getMessage());

            return "Error :";
        }

        

    }


    //method to count the number of pending loan requests from the loan requests
    private static int countLoanRequests(){
        //int counted=-1;
        
        try {
            JDBC jdbcInstance = JDBC.getInstance();
            Connection connection = jdbcInstance.getConnection();
            String querry = " select count(LoanStatus) as PendingRequests from sacco_loan_requests  where LoanStatus ='Pending' ";
            PreparedStatement statement = connection.prepareStatement(querry);
            ResultSet result =  statement.executeQuery();

            if (result.next()) {
               int  countedPendings = result.getInt("PendingRequests");
                return countedPendings;
                
            }else{
                return 0;
            }
            
            
        } catch (Exception e) {
            System.out.println("Eror :"+e.getMessage());
            return 0;
            
        }
        
       
    }


    //method to calculate the total vailable funds in the deposits table as the total available funds
    private static int availableFunds(){

        int totalSaccoFunds =-1;

        try {
            JDBC jdbcInstance = JDBC.getInstance();
            Connection connection = jdbcInstance.getConnection();
            String querry ="select sum(amount) from sacco_deposits";
            PreparedStatement statement = connection.prepareStatement(querry);
            ResultSet result = statement.executeQuery();

            if (result.next()) {
                totalSaccoFunds = result.getInt("sum(amount)");
                return totalSaccoFunds;
            }


            
        } catch (Exception e) {
            System.out.println("Error :"+e.getMessage());
        }
        return 0;

    }



    // //method to calculate percentage loan progress 
    private static double loanprogress(int monthsCleared,int expectedMonths){
        
        double Ploanprogress;

        Ploanprogress = (monthsCleared/expectedMonths)*100;

        return Ploanprogress;


    }


    //method to calculate contribution progress
    private static double contributionProg(String LoanAppNo) {
        int totalamountcontributed = getFinalBalancew(LoanAppNo);
        int totalsaccofds = availableFunds();
        double ContProgress;
        ContProgress = ((double) totalamountcontributed / (double)totalsaccofds) * 100;
        return ContProgress;
    }

    

    //method to checkwhat has been obtained from the contributionProg
    private static String GroupingContributions(String LoanAppNo){

        double ContribProgress = contributionProg(LoanAppNo);

        if (ContribProgress < 50) {
            return "Low";
        }else if (ContribProgress == 50) {
            return "Average";
        }else {
            return "Better";
        }
    }



    //method to check for the status of the in put LOAN APPLICATION NUMBER
    private static String CheckStatusOfLoanAppNumber(String LoanAppNo){

        int available_funds = availableFunds();
        int countedPendings = countLoanRequests();
        

        try {
            JDBC jdbcInstance = JDBC.getInstance();
            Connection connection = jdbcInstance.getConnection();
            String querry = "select LoanStatus from sacco_loan_requests where LoanAppNumber =?";
            PreparedStatement statement =connection.prepareStatement(querry);
            statement.setString(1,LoanAppNo);
            ResultSet result = statement.executeQuery();

            if (result.next()) {
               String LoanStatus = result.getString("LoanStatus");


               if (LoanStatus.equals("Pending") ) {
                return "Pending";
               }else if (((countedPendings >= 10) && (available_funds > 2000000)) || (LoanStatus.equals("Processing"))) {
                changeStatusOfLoan();
                if ((LoanStatus.equals("Processing"))) {

                    return "Processing";
                    
                }else {
                    return "Active";
                }
                
               }
            
            }


        } catch (Exception e) {
            System.out.println(e.getMessage());
           
        }
        return "No status";
    }


    //method to handle @ scenario in GroupingContributions
    private static double LoanFromSystem(String LoanAppNo){
        //int amountToGive = In
        double give =-1.0;
        String LoanDistributionResult = GroupingContributions(LoanAppNo);
        //String username =null ;

        if (LoanDistributionResult.equals("Low")) {
            give = getFinalBalancew(LoanAppNo)*0.25;
            return give;
        }else if (LoanDistributionResult.equals("Average")) {
            give = getFinalBalancew(LoanAppNo)*0.5;
            return give;
        }else{
            give = getFinalBalancew(LoanAppNo)*0.75;
            return  give;
        }
    }



    //method to change the loan status after calculating the loan to be given 
    private static void changeStatusOfLoan() {
        try {
            JDBC jdbcInstance = JDBC.getInstance();
            Connection connection = jdbcInstance.getConnection();

            String query = "UPDATE sacco_loan_requests SET LoanStatus = 'Processing' WHERE LoanStatus = 'Pending'";
            PreparedStatement statement = connection.prepareStatement(query);
            statement.executeUpdate();

            //int rowsAffected = statement.executeUpdate();

            // if (rowsAffected > 0) {
            //     return "Processing";
            // }
        } catch (Exception e) {
            System.out.println("Error! " + e.getMessage());
        }
        //return "status not updated";
    }


    //method to check whether the input loanApplication number is valid
    private static String validateLaonApplicationNumberofCheckStatus(String LoanAppNo){

        String gottenApplicationNumber =null;

        try {
            JDBC jdbcInstance = JDBC.getInstance();
            Connection connection = jdbcInstance.getConnection();

            String querry = "select LoanAppNumber from sacco_loan_requests where LoanAppNumber =?";
            PreparedStatement statement =connection.prepareStatement(querry);
            statement.setString(1,LoanAppNo);
            ResultSet result = statement.executeQuery();

            if (result.next()) {
                gottenApplicationNumber = result.getString("LoanAppNumber");
                return gottenApplicationNumber;
            }else{
                return "Not gotten";
            }
            
        } catch (Exception e) {
            System.out.println("Error :"+e.getMessage());
            return "Not found ";
        }
        


    }


    //METHOD TO MARK THE RECEIPT NUMBER AS USED FOR A SINGLE DEPOSIT
    private static void markReceiptAsUsed(int receiptNumber) {
        try {
            JDBC jdbcInstance = JDBC.getInstance();
            Connection connection = jdbcInstance.getConnection();

            String updateQuery = "UPDATE sacco_deposits SET used = 1 WHERE receiptNumber = ?";
            PreparedStatement statement = connection.prepareStatement(updateQuery);
            statement.setInt(1, receiptNumber);
            statement.executeUpdate();
        } catch (SQLException e) {
            System.out.println("Error marking receipt as used: " + e.getMessage());
        }
    }






}




 

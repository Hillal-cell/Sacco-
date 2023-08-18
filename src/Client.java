import java.io.*;
import java.net.*;
import java.util.*;

public class Client {


    public static void main(String[] args) throws IOException{
        Socket  clientSoc = null;
        Scanner clientinput = null;
        Scanner fromServer = null;
        PrintWriter pr = null;
        String input =null;
       
      


        System.out.println("Client Started ...");

       
        try {
            clientSoc = new Socket("localhost",5656);    
            fromServer = new Scanner( clientSoc.getInputStream()); //this is getting message from server we read from the socket's input stream
            clientinput = new Scanner(System.in);
            pr = new PrintWriter(clientSoc.getOutputStream(),true);

            
          
            do{
               
                if (fromServer.hasNextLine()) {
                    String serverResponse = fromServer.nextLine();
                    System.out.println(serverResponse);
                  

                    if (serverResponse.equals("=============================================You have successfully logged in. Here is the secured menu:=================================")) {
                        // Read the menu options until "END_MENU" marker is received
                        StringBuilder menuBuilder = new StringBuilder();
                        String menuOption;
                        while (fromServer.hasNextLine() && !(menuOption = fromServer.nextLine()).equals("END_MENU")) {
                            menuBuilder.append(menuOption).append("\n");
                        }
                        System.out.println(menuBuilder.toString().trim()); // Display the complete menu
                    }else if (serverResponse.equals("Confirm loan:")) {

                        //System.out.println("Please type \"yes\" to confirm the suggested loan or \"no\" to reject");
                        String respond = clientinput.nextLine();

                        pr.println(respond); // Send the input to the server
                        
                    } 
                    else if (serverResponse.equals("CheckStatement")) {
                        
                        pr.println("CheckStatement"); // Send the CheckStatement command to the server
                        
                        System.out.println("Enter the date from (YYYY-MM-DD): ");
                        String dateFrom = clientinput.nextLine();
                        pr.println(dateFrom);
                        System.out.println("Enter the date to (YYYY-MM-DD): ");
                        String dateTo = clientinput.nextLine();
                        pr.println(dateTo);

                        // // Read and print the concatenated message from the server
                        // String receivedMessage = fromServer.nextLine();
                        // System.out.print(receivedMessage);
                    }
                    else if (serverResponse.startsWith("||Loan Progress:")) {
                        // Print the calculations and statement until you encounter "************************"
                        while (fromServer.hasNextLine()) {
                            String line = fromServer.nextLine();
                            if (line.equals("************************")) {
                                break;
                            }
                            System.out.println(line);
                    } 
                    }
                }


                

                
                
                input = clientinput.nextLine(); 
                pr.println(input);
                
                
                


            }while (!input.equalsIgnoreCase("logout"));

            



        } catch (Exception e) {
            
            System.out.println(e.getMessage());
        }
        
       
    }

    
    
}

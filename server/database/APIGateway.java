package server.database;

import java.sql.*;

public class APIGateway{

    private static APIGateway onlyInstance;
    private String DBURL;
    private String password;
    private String username;
    private Connection dbConnect;
    private ResultSet results;

    //private constructor
    private APIGateway(){

    }

    //establishes connection to database
    public void connectToDB(){
        try{
            dbConnect = DriverManager.getConnection(DBURL, username, password);
        }catch(SQLException e){
            e.printStackTrace();
        }
    }

    //sends query to database, query can be of any type
    public String queryDB(String query){
        try{
            Statement myStmt = dbConnect.createStatement();
            results = myStmt.executeQuery(query);
        }catch(SQLException e){
            e.printStackTrace();
        }
        return convertResponse();
    }

    //getter for singleton object
    public static APIGateway getOnlyInstance(){
        if(onlyInstance==null){
            onlyInstance = new APIGateway();
        }
        return onlyInstance;
    }

    //convert results to string format compatible with the microservices
    private String convertResponse(){
        return results.toString();
    }

    //close connection to database
    public void closeConnection(){
        try{
            results.close();
            dbConnect.close();
        }catch(SQLException e){
            e.printStackTrace();
        }
    }
}
package server.database;

import java.util.*;

public class MessageBroker{

    private static MessageBroker onlyInstance;
    private ArrayList<String> buffer;

    //private constructor
    private MessageBroker(){
        buffer = new ArrayList<>();
    }

    //getter for singleton object
    public MessageBroker getOnlyInstance(){
        if(onlyInstance==null){
            onlyInstance = new MessageBroker();
        }
        return onlyInstance;
    }

    //getter for buffer
    public ArrayList<String> getBuffer(){
        return buffer;
    }

    //adds to buffer
    public void addToBuffer(String input){
        getOnlyInstance().getBuffer().add(input);
    }

    //sends first item in buffer to API, removes item from buffer and returns query result
    private String sentToAPI(){
        String query = getOnlyInstance().getBuffer().get(0);
        getOnlyInstance().getBuffer().remove(0);
        String result = APIGateway.getOnlyInstance().queryDB(query);
        return result;
    }
}
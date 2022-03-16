package server.User;

public class User {
    private String type;
    private String username;
    private String password;
    private String address;
    private int id;

    //consturctor
    public User(String type, String username, String password, String address, int id){
        this.type = type;
        this.username = username;
        this.password = password;
        this.address = address;
        this.id = id;
    }

    //getter for type
    public String getType(){
        return this.type;
    }

    //setter for type
    public void setType(String type){
        this.type = type;
    }

    //getter for username
    public String getUsername(){
        return this.username;
    }

    //setter for username
    public void setUsername(String username){
        this.username = username;
    }

    //getter for password
    public String getPassword(){
        return this.password;
    }

    //setter for password
    public void setPassword(String password){
        this.password = password;
    }

    //getter for address
    public String getAddress(){
        return this.address;
    }

    //setter for address
    public void setAddress(String address){
        this.address = address;
    }

    //getter for id
    public int getID(){
        return this.id;
    }

    //setter for id
    public void setID(int id){
        this.id = id;
    }

}

package inventoryclient;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class LowStockBooksFetcher {

    private static final String SERVICE_URL = "http://localhost/inventorymanagement/public/api/";

    public static void main(String[] args) {
        try {
            getLowStockBooks();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private static void getLowStockBooks() throws Exception {
        URL url = new URL(SERVICE_URL + "getLowStockBooks.php");
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        conn.setRequestMethod("GET");

        BufferedReader in = new BufferedReader(new InputStreamReader(conn.getInputStream()));
        String inputLine;
        StringBuilder response = new StringBuilder();

        while ((inputLine = in.readLine()) != null) {
            response.append(inputLine);
        }
        in.close();

        JSONArray lowStockBooks = new JSONArray(response.toString());
        System.out.println("Books with low stock:");
        for (int i = 0; i < lowStockBooks.length(); i++) {
            JSONObject book = lowStockBooks.getJSONObject(i);
            System.out.println("Book ID: " + book.getInt("id"));
            System.out.println("Title: " + book.getString("title"));
            System.out.println("Stock: " + book.getInt("stock_quantity"));
        }
    }
}

package inventoryclient;

import javax.mail.*;
import javax.mail.internet.*;
import org.json.JSONArray;
import org.json.JSONObject;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Properties;

public class LowStockEmailSender {

    public static void main(String[] args) {
        try {
            JSONArray lowStockBooks = getLowStockBooks();
            if (lowStockBooks.length() > 0) {
                String emailContent = createEmailContent(lowStockBooks);
                sendEmail(emailContent);
            } else {
                System.out.println("No low stock books found.");
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private static JSONArray getLowStockBooks() throws Exception {
        String url = "http://localhost/inventorymanagement/public/api/getLowStockBooks.php"; // Adjust URL as needed
        HttpURLConnection conn = (HttpURLConnection) new URL(url).openConnection();
        conn.setRequestMethod("GET");
        int responseCode = conn.getResponseCode();

        if (responseCode == 200) {
            BufferedReader in = new BufferedReader(new InputStreamReader(conn.getInputStream()));
            StringBuilder response = new StringBuilder();
            String inputLine;

            while ((inputLine = in.readLine()) != null) {
                response.append(inputLine);
            }
            in.close();

            return new JSONArray(response.toString());
        } else {
            throw new Exception("Failed to fetch low stock books.");
        }
    }

    private static String createEmailContent(JSONArray lowStockBooks) {
        StringBuilder content = new StringBuilder("Low Stock Books Report:\n\n");
        for (int i = 0; i < lowStockBooks.length(); i++) {
            JSONObject book = lowStockBooks.getJSONObject(i);
            content.append("ID: ").append(book.getInt("id"))
                    .append(", Title: ").append(book.getString("title"))
                    .append(", Authors: ").append(book.getString("authors"))
                    .append(", Stock Quantity: ").append(book.getInt("stock_quantity"))
                    .append("\n");
        }
        return content.toString();
    }

    private static void sendEmail(String content) {
        String to = "amir.ryugasaki@gmail.com"; // Change to your recipient email
        String from = "muhammadahb-wm21@student.tarc.edu.my"; // Change to your sender email
        String host = "smtp.gmail.com"; // Change to your SMTP server

        Properties properties = new Properties();
        properties.put("mail.smtp.host", host);
        properties.put("mail.smtp.port", "587");
        properties.put("mail.smtp.auth", "true");
        properties.put("mail.smtp.starttls.enable", "true");

        Session session = Session.getInstance(properties, new javax.mail.Authenticator() {
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication("muhammadahb-wm21@student.tarc.edu.my", "030214141085"); // Change to
                                                                                                           // your email
                // and password
            }
        });

        try {
            MimeMessage message = new MimeMessage(session);
            message.setFrom(new InternetAddress(from));
            message.addRecipient(Message.RecipientType.TO, new InternetAddress(to));
            message.setSubject("Daily Low Stock Report");
            message.setText(content);

            Transport.send(message);
            System.out.println("Email sent successfully.");
        } catch (MessagingException e) {
            e.printStackTrace();
        }
    }
}

import requests
import smtplib
from email.mime.text import MIMEText
import schedule
import time

SERVICE_URL = "http://localhost/Bookstore_Management_System\BookStore\public\api\getLowStockBooks.php"
EMAIL_TO = "amir.ryugasaki@gmail.com"
EMAIL_FROM = "muhammadahb-wm21@student.tarc.edu.my"
SMTP_SERVER = "smtp.gmail.com"
SMTP_PORT = 587
EMAIL_PASSWORD = "030214141085"  # Change to your actual email password

def get_low_stock_books():
    response = requests.get(SERVICE_URL)
    if response.status_code == 200:
        return response.json()
    else:
        raise Exception("Failed to fetch low stock books.")

def create_email_content(low_stock_books):
    content = "Low Stock Books Report:\n\n"
    for book in low_stock_books:
        content += f"ID: {book['id']}, Title: {book['title']}, Authors: {book['authors']}, Stock Quantity: {book['stock_quantity']}\n"
    return content

def send_email(content):
    msg = MIMEText(content)
    msg['Subject'] = "Daily Low Stock Report"
    msg['From'] = EMAIL_FROM
    msg['To'] = EMAIL_TO

    with smtplib.SMTP(SMTP_SERVER, SMTP_PORT) as server:
        server.starttls()
        server.login(EMAIL_FROM, EMAIL_PASSWORD)
        server.send_message(msg)

def job():
    try:
        low_stock_books = get_low_stock_books()
        if low_stock_books:
            email_content = create_email_content(low_stock_books)
            send_email(email_content)
            print("Email sent successfully.")
        else:
            print("No low stock books found.")
    except Exception as e:
        print(e)

# Schedule the job to run daily at 11:59 PM
schedule.every().day.at("22:55").do(job)

if __name__ == "__main__":
    while True:
        schedule.run_pending()
        time.sleep(60)  # Wait one minute

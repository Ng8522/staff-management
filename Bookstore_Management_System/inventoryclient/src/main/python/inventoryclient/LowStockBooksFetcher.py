import requests

SERVICE_URL = "http://localhost/Bookstore_Management_System\BookStore\public\api\getLowStockBooks.php"

def get_low_stock_books():
    response = requests.get(SERVICE_URL)
    if response.status_code == 200:
        low_stock_books = response.json()
        print("Books with low stock:")
        for book in low_stock_books:
            print(f"Book ID: {book['id']}")
            print(f"Title: {book['title']}")
            print(f"Stock: {book['stock_quantity']}")
    else:
        print("Failed to fetch low stock books.")

if __name__ == "__main__":
    get_low_stock_books()

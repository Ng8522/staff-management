<?php
/**
 * File Name: XmlController.php
 * Description: Control the viewwing, update of Book records in XML, XSLT and XPAHT format
 *
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class XmlController
{
    public function showXml()
    {
        $xmlPath = storage_path('app\public\books.xml');
        return response()->file($xmlPath);
    }

    public function showXslt()
    {
        $xsltPath = storage_path('app\public\books.xslt');
        return response()->file($xsltPath);
    }

    public function showXPath(Request $request)
    {
        $xmlPath = storage_path('app\public\books.xml');
        $xml = simplexml_load_file($xmlPath);

        // Example XPath query: select all books
        $books = $xml->xpath('/inventory/book'); // Correct XPath for inventory root

        return view('xpath_results', compact('books'));
    }
}

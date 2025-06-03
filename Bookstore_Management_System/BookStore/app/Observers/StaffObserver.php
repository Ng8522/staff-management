<?php
/**
 * File Name: StaffObserver.php
 * Description:  Staf Observer in Observer pattern
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */
namespace App\Observers;

use App\Observers\ObserverInterface;

class StaffObserver implements ObserverInterface
{
    public function update(): void
    {
        // Here you can handle reloading the page or fetching updated book records
        session(['book_updated' => true]);
        echo "Staff notified: Book record updated. Page reload required.";


    }
}

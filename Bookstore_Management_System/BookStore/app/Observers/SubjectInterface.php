<?php
/**
 * File Name: SubjectInterface.php
 * Description:  SubjectInterface in Observer pattern
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */
namespace App\Observers;

interface SubjectInterface
{
    public function attach(ObserverInterface $observer);
    public function detach(ObserverInterface $observer);
    public function notify();
}

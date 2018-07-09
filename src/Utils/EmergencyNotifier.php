<?php
/**
 * Created by PhpStorm.
 * User: zek
 * Date: 29/06/18
 * Time: 12.13
 */

namespace App\Utils;


class EmergencyNotifier
{
    static function startEmergency()
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $firebaseKey = 'AAAAHDILXXY:APA91bGRJB2RtBSG-sXSoYumCWzr5bqefN6co-WGC-0e5kq6RgfqLbNmvlZ4caMKs0Xb8akYliCJALF7zwxeQJA9UVdyrp6xhVh66npGxhSEiJAs_8xCzJVYtdg85Cv4pK9rzPsVR6zF';
        $post_data = self::getJsonEmergencyData();

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/json", "Authorization: key=" . $firebaseKey));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch);

        curl_close($ch);
    }

    static function stopNotification()
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $firebaseKey = 'AAAAHDILXXY:APA91bGRJB2RtBSG-sXSoYumCWzr5bqefN6co-WGC-0e5kq6RgfqLbNmvlZ4caMKs0Xb8akYliCJALF7zwxeQJA9UVdyrp6xhVh66npGxhSEiJAs_8xCzJVYtdg85Cv4pK9rzPsVR6zF';
        $post_data = self::getJsonStopData();

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/json", "Authorization: key=" . $firebaseKey));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch);

        curl_close($ch);
    }


    function getJsonEmergencyData()
    {
        return json_encode(array("data" => array("Emergenza" => "true"), "to" => "/topics/emergenza1"));
    }

    function getJsonStopData()
    {
        return json_encode(array("data" => array("Emergenza" => "false"), "to" => "/topics/emergenza1"));
    }
}
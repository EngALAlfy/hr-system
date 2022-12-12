<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogViewerController extends Controller
{
    //

    public function getAllLogErrors()
    {
        $files = Storage::disk('logs')->allFiles();

        $files = array_filter($files, function ($i) {
            return strpos($i, '.log');
        });

        // if (empty($files)) {
        //     return [];
        // }

        array_reverse($files);

        $logs = [];

        foreach ($files as $key => $value) {

            $file = Storage::disk('logs')->get($value);

            $pattern = "/^\[(?<date>.*)\]\s(?<env>\w+)\.(?<type>\w+):(?<message>.*)/m";

            preg_match_all($pattern, $file, $matches, PREG_SET_ORDER, 0);


            foreach ($matches as $key => $value) {
                $logs[] = [
                    'time' => $value['date'],
                    'env' => $value['env'],
                    'type' => $value['type'],
                    'message' => $value['message'],
                ];
            }
        }

        return  view('errors-logger.index' , compact('logs'));
    }



    public function getAllDates()
    {
        $files = Storage::disk('logs')->allFiles();


        $files = array_filter($files, function ($i) {
            return strpos($i, '.log');
        });

        if (empty($files)) {
            return [];
        }

        array_reverse($files);

        // dates array

        $dates = [];

        foreach ($files as $key => $value) {
            $pattern = '/(?<=laravel-)(.*)(?=.log)/';
            preg_match($pattern, $value, $matches);
            array_push($dates, $matches[0]);
        }

        // $file = Storage::disk('logs')->get($files[1]);

        return  $dates;
    }

    public function getLogDetails($date)
    {
        $filename = 'laravel-' . $date . '.log';
        $file = Storage::disk('logs')->get($filename);

        $pattern = "/^\[(?<date>.*)\]\s(?<env>\w+)\.(?<type>\w+):(?<message>.*)/m";

        preg_match_all($pattern, $file, $matches, PREG_SET_ORDER, 0);

        $logs = [];
        foreach ($matches as $key => $value) {
            $logs[] = [
                'time' => $value['date'],
                'env' => $value['env'],
                'type' => $value['type'],
                'message' => $value['message'],
            ];
        }
        return $logs;
    }
}

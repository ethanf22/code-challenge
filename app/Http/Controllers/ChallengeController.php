<?php

namespace App\Http\Controllers;

use App\Employee;
use JavaScript;

class ChallengeController extends Controller
{
    public $employees_by_id;
    public $distance_from_ceo = [];

    /**
     * Grabs all of the employees and orders than by boss id and then name.
     * Based on the page number, calculate the distance from the CEO for the 100
     * employees that are going to be displayed on this page. Pass the data to
     * the view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //Grab all of the employees, order by and boss id.
        //Also set the array index to the employee id.

        $this->employees_by_id = Employee::orderBy('bossId')
                                         ->get()
                                         ->keyBy('id');

        $employees = [];

        //Loop through the employees and calculate the distance from the ceo.
        foreach($this->employees_by_id as $employee) {
            $distance = $this->getDistance($employee['id']);

            //Add items to the array to send to javascript. Order is important, items will be rendered as columns.
            $employees[] = [
                $employee['name'],
                $this->employees_by_id[$employee['bossId']]['name'],
                $distance,
            ];
        }

        //Outputing the value to javascript (footer.blade.php via the Javascript class/Facade)
        //Doing this so that the page doesn't flicker or jump around while DataTables re-renders it.
        Javascript::put([
            'employees' => $employees
        ]);

        return view('index');
    }

    /**
     * Calculates the distance from the ceo for the employee id that's passed in.
     *
     * @param $employee_id
     *
     * @return int
     */
    public function getDistance($employee_id)
    {
        $distance = 0;

        //Start the current id at the passed in employee id
        $current_id = $employee_id;

        /*
         * Set the current id to the boss id of the employee,
         * continue until the boss id is equal to the employee id, indicating the ceo.
         * Increment the distance variable each loop.
         */
        while($this->employees_by_id[$current_id]->bossId !== $current_id) {
            $current_employee = $this->employees_by_id[$current_id];
            $current_id = $current_employee->bossId;

            $distance++;
        }

        return $distance;
    }
}

## Coding Challenge

This site is a completion of a coding challenge.

Of note, the site displays a list of employees, their boss' name, and the distance from the CEO.

In addition to the main challenge:
* The site uses DataTables to display the results
* Lets users page through the results
* Lets users sort the columns

---

### Files of Note
* `app/Http/Controllers/ChallengeController.php`
	* This file holds the bulk of the application. Within this file are two functions:
		* `index()` which gathers the employees to render, loops through them and determines
		the distance from the CEO by calling:
		* `getDistance()` traverses an associative array connecting employee to boss until
		the CEO is reached and returning the number of levels travelled.
* `app/Employee.php`
	* This file extends the Laravel Eloquent class and wraps up the sql statement to get
	the employees in a simple, fluent format.
* `public/js/app.js`
	* Created the DataTable table. The array of employees created in the `ChallengeController`
	is passed into javascript with a special Laravel class where this file passed uses it 
	in the DataTable options array. I'm doing it this way as a blank screen on initial load is 
	perferable to a screen that jumps about when the table renders.
* `resouces/views/index.blade.php`
	* This is the html file that is rendered when accessing [the page](http://gosolid.ethanfederman.com)

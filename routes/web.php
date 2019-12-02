<?php

use App\Staff;
use App\Photo;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('create', function () {
    
    $staff = Staff::find(1);

    $staff->photos()->create(['path'=>'example.jpg']);

    echo "Done";
});

Route::get('read', function () {

    $staff = Staff::findOrFail(1);

    foreach($staff->photos as $photo){

        return $photo->path;
    }
    /*
    AT THIS POINT IN TIME - This is my understanding

    Using the staff model gotten by line 32, loop through the array of information returned using foreach [as photo, like copy to photo]
    because staff & photos has a relation ship return that within variable photo
    Within that there array value, show us the item held in path.

    */
});

Route::get('update', function () {
    
    $staff = Staff::findOrFail(1);

    $photo = $staff->photos()->whereId(1)->first();

    $photo->path = "Update example.jpg";

    $photo->save();

    echo 'done';
});

Route::get('del', function () {
    
    $staff = Staff::findOrFail(1);

    $staff->photos()->whereId(1)->delete();

    echo 'done';

});

Route::get('assign', function () {

    $staff = Staff::findOrFail(1);

    $photo = Photo::findOrFail(4);

    $staff->photos()->save($photo);

    //this creates a relationship between staff member 1 to photo id 4
});

Route::get('unassign', function () {
    
    $staff = Staff::findOrFail(1);

    // $photo = Photo::findOrFail(4);

    $staff->photos()->whereId(2)->update(['imageable_id'=>'','imageable_type'=>'']);

});
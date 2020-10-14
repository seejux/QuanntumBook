<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function () {
  Route::get('/home', 'HomeController@index')->name('home');
  Route::post('/save-options', 'HomeController@store')->name('home.store');

  Route::get('/options', 'OptionsController@index')->name('options');
  Route::post('/change-password', 'OptionsController@changePassword')->name('change-password');


  Route::get('/edit-chapter/{chapterNumber}', 'EditChapterController@index')->name('edit-chapter.show');
  Route::get('/edit-chapter/{chapterNumber}/{subChapterNumber}', 'EditChapterController@index')->name('edit-chapter.show');

  Route::post('/edit-chapter/{chapterNumber}', 'EditChapterController@store')->name('edit-chapter.store');
  Route::post('/edit-chapter/{chapterNumber}/{subChapterNumber}', 'EditChapterController@store')->name('edit-chapter.store');

  Route::get('/edit-two-level-chapter/{chapterNumber}', 'EditTwoLevelChapterController@index')->name('edit-two-level-chapter.show');

  Route::get('/media', 'MediaController@index')->name('media.show');
  Route::post('/media', 'MediaController@store')->name('media.store');
  Route::post('/media/delete/{imageNames}', 'MediaController@deleteImages')->name('media.deleteImages');

  Route::get('/chapters', 'ChaptersController@index')->name('chapters');
  Route::get('/quizzes', 'QuizzesController@index')->name('quizzes');

  Route::get('/edit-quiz/{quizNumber}', 'EditQuizController@index')->name('edit-quiz.show');
  Route::post('/save-quiz', 'EditQuizController@store')->name('edit-chapter.store');
});

Auth::routes(['register' => false]);

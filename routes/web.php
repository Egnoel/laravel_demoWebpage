<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function ()  {
    $jobs = Job::with('employer')->latest()->paginate(3);
    return view('jobs.index',
        ['jobs'=> $jobs
        ]);
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::get('/jobs/{id}', function ($id) {

    $job = Job::find((int) $id);
    return view('jobs.show', ['job'=>$job]);
});

Route::post('/jobs', function () {

    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    Job::create(
        [
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]
    );
    return redirect('/jobs');
});

Route::get('/jobs/{id}/edit', function ($id) {

    $job = Job::find((int) $id);
    return view('jobs.edit', ['job'=>$job]);
});

Route::patch('/jobs/{id}', function ($id) {
    // validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);
    // authorize

    // update the job
    $job = Job::findOrFail((int) $id);
    $job->update(
        [
            'title' => request('title'),
            'salary' => request('salary'),
        ]
    );

    // redirect to the job
    return redirect('/jobs/'.$job->id);
});

Route::delete('/jobs/{id}', function ($id) {
    // authorize

    // delete the job
        Job::findOrFail((int) $id)->delete();
    // redirect
    return redirect('/jobs');

});

Route::get('/contact', function () {
    return view('contact');
});

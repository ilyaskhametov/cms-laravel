<?php
/**
 * @var Illuminate\Support\Collection $pages
 */
?>

@extends('layout.index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter page name" />
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

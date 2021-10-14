@extends('layouts.admin')

@section('content')

    <livewire:admin.users.edit-user :user="$user" />

@endsection
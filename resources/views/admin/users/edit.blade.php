@extends('layouts.admin')

@section('content')

    <livewire:admin.users.edit :userId="$id" />

@endsection
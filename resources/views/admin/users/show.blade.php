@extends('layouts.admin')

@section('content')

    <livewire:admin.users.show :userId="$id" />

@endsection
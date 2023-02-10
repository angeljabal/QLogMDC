<div>
    <input type="text" class="form-control" autofocus wire:model="idNum">
    {{-- <button class="btn btn-primary mt-2" wire:click="add" type="submit">Submit</button> --}}
    <div class="form-group mt-3 d-grid gap-2 d-md-flex justify-content-end">
        <button class="btn btn-primary" type="submit" wire:click="export()">
            Export Logs
        </button>
    </div>
    <table class="table mt-5">
        <thead>
            <th>Full Name</th>
            <th>Date</th>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td><h5>{{$log->user->fname . ' ' . $log->user->lname}}</h5></td>
                    <td>
                        {{\Carbon\Carbon::parse($log->created_at)->format('d/m/Y')}}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {{$logs->links()}}

</div>

<div>
    <input type="text" class="form-control" autofocus wire:model="idNum">
    <h2 class="mt-3">{{}}</h2>
    {{-- <button class="btn btn-primary mt-2" wire:click="add" type="submit">Submit</button> --}}
    <div class="form-group mt-3 d-grid gap-2 d-md-flex justify-content-end">
        <button class="btn btn-primary" type="submit" wire:click="export()">
            Export Logs
        </button>
    </div>
    <table class="table mt-5">
        <thead>
            <th>Full Name</th>
            {{-- <th>Actions</th> --}}
        </thead>
        <tbody>
            @foreach ($availableIds as $a)
                <tr>
                    <td>{{$a->user->fname . ' ' . $a->user->lname}}</td>
                    {{-- <td><button class="btn btn-danger">&cross;</button></td> --}}
                </tr>
            @endforeach
        </tbody>

    </table>
    {{$availableIds->links()}}

</div>

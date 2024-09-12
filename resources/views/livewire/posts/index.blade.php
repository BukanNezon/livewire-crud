@section('title')
Data Posts - Belajar Livewire 3 di SantriKoding.com
@endsection

<div class="container mt-5 mb-5">

    <p>ini adalah post index</p>
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- flash message -->
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
            <!-- end flash message -->
            <div class="mb-3">
                @livewire('post-form')
            </div>
            
            <div class="card">
                <div class="card-header">Post</div>
                <div class="card-body">
                    @livewire('post-table')
                </div>
            </div>
        </div>
    </div>
</div>
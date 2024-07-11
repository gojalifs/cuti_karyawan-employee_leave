@extends('layouts/index')

@section('content')
@section('content')
    <div class="main-content" style="min-height: 562px;">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <Form method="POST" action="{{ route('cuti.update') }}">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h4>Form Edit Master Cuti</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Cuti</label>
                                        <input type="hidden" class="form-control" name="id"
                                            value="{{ $cuti->id }}">
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $cuti->nama_cuti }}" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="text" class="form-control" name="jumlah"
                                            value="{{ $cuti->jumlah }}" required>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    </div>
                                </div>
                        </Form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

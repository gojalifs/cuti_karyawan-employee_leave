@extends('layouts/index')

@section('content')
    <div class="main-content" style="min-height: 562px;">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <Form method="POST" action="{{ route('karyawan.update') }}">
                            @csrf
                            @foreach ($karyawan as $k)
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Form Edit Karyawan</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="hidden" class="form-control" name="id"
                                                value="{{ $k->id }}">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $k->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email"
                                                value="{{ $k->email }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Departemen</label>
                                            <select name="dept" id="dept" style="min-width: 100%; padding: 8px;"
                                                required>
                                                @foreach ($dept as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_dept }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ $k->address }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>No Telpon</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ $k->phone }}" required>
                                        </div>

                                        <div>Jenis Cuti</div>
                                        <div>                                            
                                            @foreach ($cuties as $key => $cuti)
                                                <div class="form-check">
                                                    <label for="{{ $cuti->id }}"
                                                        class="form-check-label">{{ $cuti->nama_cuti }}
                                                    </label>
                                                    <input type="checkbox" class="form-check-input" name="cuti[]"
                                                        id="{{ $cuti->id }}" value="{{ $cuti->id }}">
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="form-group">
                                            <label>Kata Sandi Baru</label>
                                            <input id="password" type="text" class="form-control" name="password">
                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                        </div>
                                    </div>
                            @endforeach
                        </Form>

                    </div>

                </div>
            </div>
        </section>
        <div class="settingSidebar">
            <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
            </a>
            <div class="settingSidebar-body ps-container ps-theme-default" tabindex="2"
                style="overflow: hidden; outline: none;">
                <div class=" fade show active">
                    <div class="setting-panel-header">Setting Panel
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Select Layout</h6>
                        <div class="selectgroup layout-color w-50">
                            <label class="selectgroup-item">
                                <input type="radio" name="value" value="1" class="selectgroup-input select-layout"
                                    checked="">
                                <span class="selectgroup-button">Light</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="value" value="2" class="selectgroup-input select-layout">
                                <span class="selectgroup-button">Dark</span>
                            </label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Sidebar Color</h6>
                        <div class="selectgroup selectgroup-pills sidebar-color">
                            <label class="selectgroup-item">
                                <input type="radio" name="icon-input" value="1"
                                    class="selectgroup-input select-sidebar">
                                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                    data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="icon-input" value="2"
                                    class="selectgroup-input select-sidebar" checked="">
                                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                    data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                            </label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Color Theme</h6>
                        <div class="theme-setting-options">
                            <ul class="choose-theme list-unstyled mb-0">
                                <li title="white" class="active">
                                    <div class="white"></div>
                                </li>
                                <li title="cyan">
                                    <div class="cyan"></div>
                                </li>
                                <li title="black">
                                    <div class="black"></div>
                                </li>
                                <li title="purple">
                                    <div class="purple"></div>
                                </li>
                                <li title="orange">
                                    <div class="orange"></div>
                                </li>
                                <li title="green">
                                    <div class="green"></div>
                                </li>
                                <li title="red">
                                    <div class="red"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <div class="theme-setting-options">
                            <label>
                                <span class="control-label p-r-20">Mini Sidebar</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                    id="mini_sidebar_setting">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <div class="theme-setting-options">
                            <div class="disk-server-setting m-b-20">
                                <p>Disk Space</p>
                                <div class="sidebar-progress">
                                    <div class="progress" data-height="5" style="height: 5px;">
                                        <div class="progress-bar l-bg-green" role="progressbar" data-width="80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 80%;"></div>
                                    </div>
                                    <span class="progress-description">
                                        <small>26% remaining</small>
                                    </span>
                                </div>
                            </div>
                            <div class="disk-server-setting">
                                <p>Server Load</p>
                                <div class="sidebar-progress">
                                    <div class="progress" data-height="5" style="height: 5px;">
                                        <div class="progress-bar l-bg-orange" role="progressbar" data-width="58%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 58%;"></div>
                                    </div>
                                    <span class="progress-description">
                                        <small>Highly Loaded</small>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                        <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                            <i class="fas fa-undo"></i> Restore Default
                        </a>
                    </div>
                </div>
            </div>
            <div id="ascrail2001" class="nicescroll-rails nicescroll-rails-vr"
                style="width: 8px; z-index: 999; cursor: default; position: absolute; top: 0px; left: 272px; height: 200px; display: block; opacity: 0;">
                <div class="nicescroll-cursors"
                    style="position: relative; top: 0px; float: right; width: 6px; height: 583px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;">
                </div>
            </div>
            <div id="ascrail2001-hr" class="nicescroll-rails nicescroll-rails-hr"
                style="height: 8px; z-index: 999; top: 192px; left: 0px; position: absolute; cursor: default; display: none; width: 272px; opacity: 0;">
                <div class="nicescroll-cursors"
                    style="position: absolute; top: 0px; height: 6px; width: 280px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px; left: 0px;">
                </div>
            </div>
        </div>
    </div>
@endsection

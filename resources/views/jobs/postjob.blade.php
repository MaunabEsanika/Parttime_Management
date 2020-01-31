    @extends('layouts.auth')

@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <div class="container">
            <form action="/job" enctype="multipart/form-data" method="post">
            <a href="/hotel/{{auth()->user()->id}}" class="btn btn-info" role="button"> Kembali</a>
            <br/>
            <br/>
                {{ csrf_field() }}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="area">Area:</label>
                                <input type="text"
                                       class="form-control"
                                       name="area"
                                       required="required"/>
                            </div>
                            <label for="posisi">Posisi</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" id="posisi" name="posisi">
                                    <option selected>Posisi</option>
                                    <option value="1">Laundry</option>
                                    <option value="2">Pool Maintenance</option>
                                    <option value="3">Equipment Maintenance</option>
                                    <option value="4">Receptionist</option>
                                    <option value="5">Porter</option>
                                    <option value="6">Security</option>
                                    <option value="7">Valet</option>
                                    <option value="8">Concierge</option>
                                    <option value="9">House Keeping</option>
                                    <option value="10">Room Service</option>
                                    <option value="11">Waiter/Waitress</option>
                                    <option value="12">Crew Restaurant</option>
                                    <option value="13">Barista</option>
                                    <option value="14">Photographer</option>
                                    <option value="15">Cleaning Service</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai:</label>
                    <input type="date"
                           class="form-control"
                           name="tanggal_mulai"
                           required="required">
                </div>
                <div class="form-group">
                    <label for="waktu_mulai">Waktu Mulai:</label>
                    <input type="time"
                           class="form-control"
                           name="waktu_mulai"
                           required="required">
                </div>
                <div class="form-group">
                    <label for="waktu_selesai">Waktu Selesai:</label>
                    <input type="time"
                           class="form-control"
                           name="waktu_selesai"
                           required="required">
                </div>
                <div class="form-group">
                    <label for="tinggi_minimal">Tinggi Minimal:</label>
                    <input type="number"
                           class="form-control"
                           name="tinggi_minimal">
                </div>
                <div class="form-group">
                    <label for="tinggi_maksimal">Tinggi Maksimal:</label>
                    <input type="number"
                           class="form-control"
                           name="tinggi_maksimal">
                </div>
                <div class="form-group">
                    <label for="berat_minimal">Berat Minimal:</label>
                    <input type="number"
                           class="form-control"
                           name="berat_minimal">
                </div>
                <div class="form-group">
                    <label for="berat_maksimal">Berat Maksimal:</label>
                    <input type="number"
                           class="form-control"
                           name="berat_maksimal"
                           >
                </div>
                <div class="form-group">
                    <label for="kuota">Kuota: </label>
                    <input type="number"
                           class="form-control"
                           name="kuota"
                           required="required">
                </div>
                <div class="form-group">
                    <label for="bayaran">Bayaran:</label>
                    <input type="text"
                           class="form-control"
                           name="bayaran"
                           required="required"/>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
{{--                    <textarea type="text"--}}
{{--                              class="form-control"--}}
{{--                              name="deskripsi"--}}
{{--                              required="required"></textarea>--}}
                    <textarea id="my-summernote" name="deskripsi" type="text"></textarea>

                </div>
                <input type="submit" class="btn btn-primary" value="Simpan Data">
            </form>
        </div>
    </div>
</div>
@endsection

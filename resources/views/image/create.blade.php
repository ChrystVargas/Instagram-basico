@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <div class="card">
                    <div class="card-header">
                        Subir nueva imagen
                    </div>
                    <div class="card-body">
                        <form action="{{ route('image.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-avatar form-group row">
                                <label for="image_path" class="col-md-4 col-form-label text-md-right">Imagen</label>

                                <div class="col-md-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image_path') is-invalid @enderror" id="image_path" name="image_path" lang="es" autocomplete="image_path" required>
                                        <label class="custom-file-label" for="image_path">Seleccionar Archivo</label>
                                    </div>

                                    @error('image_path')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Descripcion</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autofocus></textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Subir imagen</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

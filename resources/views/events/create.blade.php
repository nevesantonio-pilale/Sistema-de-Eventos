@extends('layouts.main')

@section('title', 'Criar Eventos')

@section('content')
    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h2> Crie o seu evento </h2>

        <form action="/events" Method= "POST" enctype= "multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image"> Carregue a imagem do evento: </label>
                <input type="file" id= "image" name= "image" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="title"> Evento: </label>
                <input type="text" class="form-control" name="title" id= "title" placeholder= "Nome do seu evento">
            </div>

            <div class="form-group">
                <label for="date"> Data do Evento: </label>
                <input type="date" class="form-control" name="date" id= "date">
            </div>

            <div class="form-group">
                <label for="title"> Cidade: </label>
                <input type="text" class="form-control" name="city" id= "city" placeholder= "Local do evento">
            </div>

            <div class="form-group">
                <label for="title">O evento é privado? </label>
                <select name="private" id="private" class="form-control">
                    <option value="0"> Não </option>
                    <option value="1"> Sim </option>
                </select>
            </div>

            <div class="form-group">
                <label for="title"> Descrição: </label>
                <textarea name="description" id="description" class="form-control" placeholder= "Descrição"></textarea>
            </div>

            <div class="form-group">
                <label for="title"> Adicione items de infrastrutura </label>
                <div class="form-goup">
                    <input type="checkbox" name="items[]" value= "cadeiras"> Cadeiras
                </div>

                <div class="form-goup">
                    <input type="checkbox" name="items[]" value= "Palco"> Palco
                </div>

                <div class="form-goup">
                    <input type="checkbox" name="items[]" value= "Cerveja gratins"> Cerveja gratins
                </div>

                <div class="form-goup">
                    <input type="checkbox" name="items[]" value= "open food"> open food
                </div>

                <div class="form-goup">
                    <input type="checkbox" name="items[]" value= "Brinds"> Brinds
                </div>
            </div>

            <input type="submit" class= "btn btn-primary" value="Criar evento ">

        </form>
    </div>
@endsection
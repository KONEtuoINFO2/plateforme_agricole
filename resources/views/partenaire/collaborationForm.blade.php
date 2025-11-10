@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 text-primary">🤝 Nouvelle collaboration</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('partenaire.collaborations.store') }}">
        @csrf

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type de collaboration</label>
            <select name="type" id="type" class="form-select" required>
                <option value="">-- Sélectionner --</option>
                <option value="achat" {{ old('type') == 'achat' ? 'selected' : '' }}>Achat</option>
                <option value="vente" {{ old('type') == 'vente' ? 'selected' : '' }}>Vente</option>
                <option value="partage" {{ old('type') == 'partage' ? 'selected' : '' }}>Partage</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">✅ Créer la collaboration</button>
        <a href="{{ route('partenaire.dashboard') }}" class="btn btn-secondary">↩️ Retour</a>
    </form>
</div>
@endsection
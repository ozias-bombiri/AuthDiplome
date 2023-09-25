<div class='btn-group'>
    <a data-tooltip="Détails" href="{{ route('signataire_etablissements.show', $id) }}" class='data-tooltip btn btn-success'>
       <i class="bi bi-eye-fill"></i>
    </a>
    <a data-tooltip="Modifier" href="{{ route('signataire_etablissements.edit', $id) }}" class='data-tooltip btn btn-info'>
       <i class="bi bi-pencil"></i>
    </a>
    <form method="POST" action="{{ route('signataire_etablissements.destroy', $id) }}">
        @csrf
        @method('delete')
        <button type="submit" class = "btn btn-danger delete-btn data-tooltip delete-btn" data-tooltip="Supprimer" href="{{ route('signataire_etablissements.destroy', $id) }}"  >
            <i class="bi bi-trash"></i>
        </button>
    </form>
    </a>
</div>
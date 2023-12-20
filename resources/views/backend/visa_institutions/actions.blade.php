<div class='btn-group'>
    <a data-tooltip="Détails" href="{{ route('resultat_academiques.show', $id) }}" class='data-tooltip btn btn-success'>
       <i class="bi bi-eye-fill"></i>
    </a>
    <a data-tooltip="Modifier" href="{{ route('resultat_academiques.edit', $id) }}" class='data-tooltip btn btn-info'>
       <i class="bi bi-pencil"></i>
    </a>
    <form method="POST" action="{{ route('resultat_academiques.destroy', $id) }}">
        @csrf
        @method('delete')
        <button type="submit" class = "btn btn-danger delete-btn data-tooltip delete-btn" data-tooltip="Supprimer" href="{{ route('resultat_academiques.destroy', $id) }}"  >
            <i class="bi bi-trash"></i>
        </button>
    </form>
    </a>
</div>
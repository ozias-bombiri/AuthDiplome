<div class='btn-group'>
    <a data-tooltip="Détails" href="{{ route('annee_academiques.show', $id) }}" class='data-tooltip btn btn-success'>
       <i class="bi bi-eye-fill"></i>
    </a>
    <a data-tooltip="Modifier" href="{{ route('annee_academiques.edit', $id) }}" class='data-tooltip btn btn-info'>
       <i class="bi bi-pencil"></i>
    </a>
    <a class = "btn btn-danger delete-btn data-tooltip delete-btn" data-tooltip="Supprimer" href="{{ route('annee_academiques.destroy', $id) }}">
        <i class="bi bi-trash"></i>
    </a>
</div>
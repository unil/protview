YUI.add("yuidoc-meta", function(Y) {
   Y.YUIDoc = { meta: {
    "classes": [
        "Core.View",
        "DrawBoard.Module",
        "Structure.Model.Protein",
        "Structure.Module",
        "Structure.View.NewProteinView",
        "Structure.View.PeptideView",
        "Structure.View.ProteinView"
    ],
    "modules": [
        "Application",
        "Core",
        "DrawBoard",
        "Structure"
    ],
    "allModules": [
        {
            "displayName": "Application",
            "name": "Application",
            "description": "Contains application wide used Classes\n\nContains classes such as Context, Mediator and Sandbox\nIs also responisble for routing and global view interactions"
        },
        {
            "displayName": "Core",
            "name": "Core",
            "description": "Contains base classes which are inherited in other modules\n\nHelpers, MVC base classes, utility classes"
        },
        {
            "displayName": "DrawBoard",
            "name": "DrawBoard",
            "description": "Contains protein drawing classes\n\nDraws protein, and offers drawing related functionalities such\nas export, resizing, etc."
        },
        {
            "displayName": "Structure",
            "name": "Structure",
            "description": "Contains protein structural related classes\n\nPeptide form, Protein Form, handles all structural interactions"
        }
    ]
} };
});
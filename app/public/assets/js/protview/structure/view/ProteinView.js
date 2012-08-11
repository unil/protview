ProtView.Structure.View.ProteinView = Backbone.View.extend({
	el : '#protein-form',
	initialize : function(args) {
		this.template = _.template($('#protein-form-template').html());
	},
	events: { 
		'click #protein-form-submit' : 'submitForm'
	},
	setController : function(controller) {
		this.controller = controller;
	},
	setModel : function(model) {
		model.on('change', this.render, this);	
		model.on('reset', this.render, this);	
		this.model = model;
	},
	submitForm : function(e) {
        e.preventDefault();
        console.log(this.$('#protein-name').val());
        this.controller.save();
        /*this.collection.add({
            id : this.$('.id').val(),
            title : this.$('.title').val(),
            text : this.$('.text').val(),
            keywords : this.$('.keywords').val()
        }, { error : _.bind(this.error, this) });

        this.$('input[type="text"]').val(''); //on vide le form*/
    },
	render : function() {
		console.log('model');
		console.log(model);
		var renderedContent = this.template(this.model.toJSON());
        $(this.el).html(renderedContent);
		return this;
	},
});
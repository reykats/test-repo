$Core.recipe =
{
	aParams: {},

	init: function(aParams)
	{
		this.aParams = aParams;
	},

	build: function()
	{

	},

	submitForm : function()
	{
		return true;
	},

	checkGetFriends : function(oObj)
	{
		if ($('#privacy').val() == 4)
		{
			$Core.getFriends({
				input: 'allow_list'
			});
		}
	},

	deleteImage : function(iRecipe)
	{
		if (confirm(oTranslations['recipe.are_you_sure']))
		{
			$.ajaxCall('recipe.deleteRecipeImage', 'iRecipe=' + iRecipe);
		}
		return false;
	}
}
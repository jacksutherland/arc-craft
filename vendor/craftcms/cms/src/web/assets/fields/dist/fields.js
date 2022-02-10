!function(){var e,t;e=jQuery,t=Garnish.Base.extend({$groups:null,$selectedGroup:null,init:function(){var t=this;this.$groups=e("#groups"),this.$selectedGroup=this.$groups.find("a.sel:first"),this.addListener(e("#newgroupbtn"),"activate","addNewGroup");var r=e("#groupsettingsbtn");r.length&&(r.data("menubtn").settings.onOptionSelect=function(r){switch(e(r).data("action")){case"rename":t.renameSelectedGroup();break;case"delete":t.deleteSelectedGroup()}})},addNewGroup:function(){var e=this,t=this.promptForGroupName("");if(t){var r={name:t};Craft.postActionRequest("fields/save-group",r,(function(t,r){if("success"===r)if(t.success)location.href=Craft.getUrl("settings/fields/"+t.group.id);else if(t.errors){var o=e.flattenErrors(t.errors);alert(Craft.t("app","Could not create the group:")+"\n\n"+o.join("\n"))}else Craft.cp.displayError()}))}},renameSelectedGroup:function(){var e=this,t=this.$selectedGroup.text(),r=this.promptForGroupName(t);if(r&&r!==t){var o={id:this.$selectedGroup.data("id"),name:r};Craft.postActionRequest("fields/save-group",o,(function(t,r){if("success"===r)if(t.success)e.$selectedGroup.text(t.group.name),Craft.cp.displayNotice(Craft.t("app","Group renamed."));else if(t.errors){var o=e.flattenErrors(t.errors);alert(Craft.t("app","Could not rename the group:")+"\n\n"+o.join("\n"))}else Craft.cp.displayError()}))}},promptForGroupName:function(e){return prompt(Craft.t("app","What do you want to name the group?"),e)},deleteSelectedGroup:function(){if(confirm(Craft.t("app","Are you sure you want to delete this group and all its fields?"))){var e={id:this.$selectedGroup.data("id")};Craft.postActionRequest("fields/delete-group",e,(function(e,t){"success"===t&&(e.success?location.href=Craft.getUrl("settings/fields"):Craft.cp.displayError())}))}},flattenErrors:function(e){var t=[];for(var r in e)e.hasOwnProperty(r)&&(t=t.concat(e[r]));return t}}),Garnish.$doc.ready((function(){Craft.FieldsAdmin=new t}))}();
//# sourceMappingURL=fields.js.map
(function() {
  WysiHat.addButton('example', {
  label: 'Example',
  init: function(name, $editor) {
    /*
      DO something here to initialize any functionality needed for the RTE tool.
    */
    console.log("name",name);
    return this.parent.init(name, $editor);
  },

  handler: function(state, finalize) {
    console.log("state",state);
    console.log("finalize",finalize);
    this.Commands.insertHTML("<span>Example HTML inserted </span>");
    return false;
  }
});

})();

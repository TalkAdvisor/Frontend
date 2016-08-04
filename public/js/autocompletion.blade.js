
allSpeakers = new Bloodhound({
    datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.speaker_name); },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: allSpeakers
  });

  $('#the-basics .typeahead').typeahead({
    minLength: 1,
    highlight: true,
    hint: true
  },
  {
    name: 'speakers',
    source:  allSpeakers.ttAdapter(),
    displayKey: 'speaker_name'
  });

  $('.typeahead').bind('typeahead:select', function(ev, suggestion) {
      $(this).parent().parent().children('input[type= "hidden"]').val(suggestion.id);
  });
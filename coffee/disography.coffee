###
# discography.js
# Manages the discography section.
###

(($) ->

  ###
  # Only run this script in discography page
  ###
  if $("#discography").length

    ###
    # Assign handlers immediately after making the request,
    # and remember the jqxhr object for this request
    ###
    jqxhr = $.getJSON("/wp-content/themes/looptroop-rockers-v5/js/discography.json", ->
      $("#discography").append """
        <p class="loading">Loading discography…</p>
      """
    ).done((data) ->
      removeLoading()
      listDiscography(data)
    ).fail(->
      removeLoading()
      showError()
    )

  removeLoading = ->
    $(".loading").remove()

  showError = ->
    $("#discography").append """
      <p><strong>Oh snap!</strong> Something went wrong when loading the discography. Please try again.</p>
    """

  listDiscography = (data) ->

    ###
    # Sort obj array
    # http://www.thomasfrank.se/sorting_things.html
    ###
    data.objSort "year", -1

    for item in data

      ###
      # Fix tracks
      ###
      tracks = item.tracks.join("<li class='album__track'>")

      ###
      # Fix available as
      ###
      formats = item.available_as.join("/")

      ###
      # Generate download/listen buttons
      ###
      if item.external_links.itunes isnt null
        itunesBtn = """ <a href="#{item.external_links.itunes}" target="_blank">Download on iTunes</a><br> """
      else
        itunesBtn = ""
      if item.external_links.spotify isnt null
        spotifyBtn = """ <a href="#{item.external_links.spotify}" target="_blank">Listen on Spotify</a> """
      else
        spotifyBtn = ""

      ###
      # Display year as 4 digits
      ###
      year = item.year.toString().slice 0, -2 unless item.year is null or undefined

      ###
      # Print album
      ###
      $("#discography").append """
        <div class="album">
          <img class="album__cover" width="261" height="261" src="#{item.image}" alt="#{item.title} by #{item.artist}">
          <div class="album__release">#{year}</div>
          <div class="album__artist">#{item.artist}</div>
          <h3 class="album__title">#{item.title}</h3>
          (#{item.type}: #{formats})</p>
          #{itunesBtn}
          #{spotifyBtn}
          <h4>Tracklist</h4>
          <ol class="album__tracks"><li class="album__track">#{tracks}</ol>
        </div>
      """

) jQuery

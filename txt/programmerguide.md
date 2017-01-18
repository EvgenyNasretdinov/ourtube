Programmer's "guide"
=================

Most of the time the app work's with [Pusher's](https://pusher.com )web sockets.

When user joins the room, he sends post request wich generate event to define wich video is currently playing in this room. The server gets this information by searching in table with videos for video with current room's id.

When user adds new video or send chat message, the server creates a record in their own tables with current room id. It also sends by web socket's the information about new video/message added in current room's channel. Each user in the room is listening for this channel, so after recieving this event, they updates their clients data.

Rooms don not have their own table, so for every random string you can create a room.
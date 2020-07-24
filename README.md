# AgileDropPhp - Event Status
--------------------------------
DESCRIPTION
--------------------------------
Create a custom block which will be displayed in the sidebar on event pages. The block should display how many days are left until the event starts, example: ‘12 days left until event starts’. If the event is going to happen on the current day display 'This event is happening today'. If the event has ended, display ‘This event already passed.’.

Create a service and write a method which gets a date as a parameter and returns a value, which is then used to display correct string in the block.

The block should not be cached.

--------------------------------
VERSION
--------------------------------
- 1.0 
	- Name: Events Status
	- Date: 24.7.2020
	- Input: none
	- Output: Content to display how many day are left until the events start. 
	- SQL Tables:
	-- node__field_event_date <date>
	-- node_field_data <title>
	
--------------------------------
INSTALL
--------------------------------
- Source the repositroy to pc and copy folder "events_status" to drupal location "core/modules/custom", if custom folder doesn't exists create it
- Nagivate to Administration -> Extend install module Events Status under Custom category
- After successful installation navigate to Administration -> Structure -> Block Layout and add block to desired location
- Events content will display in block

--------------------------------
TO DO
--------------------------------
 :)
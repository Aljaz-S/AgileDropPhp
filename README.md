# AgileDropPhp - Event Status
Create a custom block which will be displayed in the sidebar on event pages. The block should display how many days are left until the event starts, example: ‘12 days left until event starts’. If the event is going to happen on the current day display 'This event is happening today'. If the event has ended, display ‘This event already passed.’.

Create a service and write a method which gets a date as a parameter and returns a value, which is then used to display correct string in the block.

The block should not be cached.

--------------------------------
TO DO
--------------------------------
- Add proper checking if result from DB returns any value

--------------------------------
INSTALL
--------------------------------
- Source the repositroy to drupal "core/modules/custom"
- Nagivate to administration install module Administration -> Extend, find "Events Status" and install it
- After successfully installation navigate to Structure -> Block and add block to desired location


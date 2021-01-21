# Laracasts PHPUnit Testing Series @ Dec 2020

PHP Array Internal Pointer helper functions

$items = ['one', 'two'];

current($items); output: one
next($items); output: two
current($items); output: two
reset($items); output: one
end($items); takes you to the last one: two

If you return next($items) and there is no next 
output: false;

Call the API request just once, for every other tests
use Stand-in Dummy.

Test Double 
- Dummy
- Mocks
- Stubs

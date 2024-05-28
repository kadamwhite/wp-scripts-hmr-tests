# wp-scripts hot-reloading tests and questions

## Installation

Clone this repo, ensure you are using Node 20, and run `npm install`.

Then, start the local WordPress test environment with `npm run env:start`.

## `--hot` does not reload CSS

Expected: Running `wp-scripts start --hot` would allow me to make changes to CSS and see those changes reflected live.

Actual: Running `npm run start` (an alias for the `wp-scripts start --hot` command) starts a DevServer instance that _says in the console_ that it is reloading, but changes to the block's `style.scss` file have no effect.

![screen recording of CSS not reloading when edited](./docs/HMR_test_1_-_styles_do_not_update.gif)

Testing: set `HMR_TEST_VARIANT` to `css-reloading` in the [`hmr-test.php` file](./hmr-test.php), then run

```
HMR_TEST_VARIANT=css-reloading npm start
```

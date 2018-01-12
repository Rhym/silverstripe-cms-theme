const CleanWebpackPlugin = require('clean-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const path = require('path');
const StyleLintPlugin = require('stylelint-webpack-plugin');

const extractSass = new ExtractTextPlugin({
  filename: '[name].css',
  disable: process.env.NODE_ENV === 'development'
});

module.exports = {
  entry: './javascripts/index.js',
  plugins: [
    new CleanWebpackPlugin(['dist']),
    extractSass,
    new StyleLintPlugin(),
  ],
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, 'dist')
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: extractSass.extract({
            use: [
              {loader: 'css-loader', options: {sourceMap: true}},
              {loader: 'postcss-loader', options: {sourceMap: true}},
              {loader: 'sass-loader', options: {sourceMap: true}}
            ],
            // use style-loader in development
            fallback: 'style-loader'
          }
        )
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf|svg)$/,
        use: [
          'file-loader'
        ]
      },
    ]
  },
};

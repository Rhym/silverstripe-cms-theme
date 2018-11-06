const CleanWebpackPlugin = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const path = require('path');
const StyleLintPlugin = require('stylelint-webpack-plugin');

const extractSass = new MiniCssExtractPlugin({
  filename: '[name].css'
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
        use: [
          { loader: MiniCssExtractPlugin.loader },
          { loader: 'css-loader', options: { sourceMap: true } },
          { loader: 'postcss-loader', options: { sourceMap: true } },
          { loader: 'sass-loader', options: { sourceMap: true } }
        ],
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

export default class Functions {
  static getRestUrl(path) {
    return wp.rest_api_base + '/' + path.replace(/^\/|\/$/g, '');
  }
}
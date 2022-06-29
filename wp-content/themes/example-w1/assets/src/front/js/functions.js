export const DEVICE = { MOBILE: 'mobile', TABLET: 'tablet', DESKTOP: 'desktop' };

export class Functions {
  static getDeviceType() {
    if (window.innerWidth < 768) return DEVICE.MOBILE;
    if (window.innerWidth < 1230) return DEVICE.TABLET;
    return DEVICE.DESKTOP;
  }

  static getParamsToDevice(params) {
    const currentDevice = Functions.getDeviceType();

    if (currentDevice === DEVICE.MOBILE) {
      return params.mobile;
    } else if (currentDevice === DEVICE.TABLET) {
      if (params.hasOwnProperty(DEVICE.TABLET)) {
        return params.tablet;
      }
      return params.mobile;
    } else {
      if (params.hasOwnProperty(DEVICE.DESKTOP)) {
        return params.desktop;
      } else if (params.hasOwnProperty(DEVICE.TABLET)) {
        return params.tablet;
      }

      return params.mobile;
    }
  }
}
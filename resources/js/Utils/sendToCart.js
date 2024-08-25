export const prepareToSend = async (from, to) => {
  const rectFrom = from.getBoundingClientRect();
  const fromX = rectFrom.left + window.scrollX;
  const fromY = rectFrom.top + window.scrollY;
  const centerFromX = fromX + (rectFrom.width / 2);
  const centerFromY = fromY + (rectFrom.height / 2);

  const rectTo = to.getBoundingClientRect();
  const toX = rectTo.left + window.scrollX;
  const toY = rectTo.top + window.scrollY;
  const centerToX = toX + (rectTo.width / 2);
  const centerToY = toY + (rectTo.height / 2);

  const css = `
    @keyframes xAxis {
      0% {
        left: ${centerFromX}px;
        top: ${centerFromY}px;
      }
      100% {
        left: ${centerToX}px;
        top: ${centerToY}px;
      }
    }
    @keyframes yAxis {
      0% {
        color: #60ca60;
      }
      100% {
        color: #336234;
      }
    }
  `
  $('#send-to-cart-style').attr('href', 'data:text/css;charset=UTF-8,' + encodeURIComponent(css))
}

export const sendToCart = async () => {

}

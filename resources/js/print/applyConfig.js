export default function (selector, config) {
  const $this = document.querySelector(selector)

  if (!$this) {
    return
  }

  // 一行テキストを指定した幅以下に保つ
  if ('textLength' in config) {
    const w = $this.clientWidth
    if (w > config.textLength) {
      $this.querySelector('tspan').setAttribute('textLength', config.textLength)
      $this.querySelector('tspan').setAttribute('lengthAdjust', 'spacingAndGlyphs')
    }
  }

  // 中央寄せ・右寄せ
  if ('text-anchor' in config) {
    const w = config.textLength
    const x = $this.getAttribute('transform').match(/translate\(([^ ]+) .+\)/)[1] ?? 0

    // 中央寄せ
    if (config['text-anchor'] === 'middle') {
      const newTransform = $this.getAttribute('transform').replace(/translate\([^ ]+ (.+)\)/, `translate(${parseFloat(x) + parseFloat(w/2)} $1)`)
      $this.setAttribute('transform', newTransform)
    }

    // 右寄せ
    if (config['text-anchor'] === 'end') {
      const newTransform = $this.getAttribute('transform').replace(/translate\([^ ]+ (.+)\)/, `translate(${parseFloat(x) + parseFloat(w)} $1)`)
      $this.setAttribute('transform', newTransform)
    }

    $this.setAttribute('text-anchor', config['text-anchor'])
  }
}

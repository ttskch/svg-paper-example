import applyConfig from './applyConfig'

applyConfig('#_顧客名_', {
    textLength: 1100,
    'text-anchor': 'middle',
})

applyConfig('#_敬称_', {
    textLength: 100,
})

for (const selector of ['#_案件名_', '#_納品先_', '#_予定納期_', '#_有効期限_']) {
    applyConfig(selector, {
        textLength: 1000,
    })
}

applyConfig('#_合計金額_', {
    textLength: 750,
})

for (const selector of ['#_作成日_', '#_見積コード_']) {
    applyConfig(selector, {
        textLength: 360,
    })
}

for (const i of [...Array(26)].keys()) {
    applyConfig(`#_商品名_${i}_`, {
        textLength: 665,
    })
    applyConfig(`#_メーカー名_${i}_`, {
        textLength: 200,
    })
    applyConfig(`#_型番_${i}_`, {
        textLength: 260,
    })
    applyConfig(`#_数量_${i}_`, {
        textLength: 60,
        'text-anchor': 'middle',
    })
    applyConfig(`#_単位_${i}_`, {
        textLength: 60,
        'text-anchor': 'middle',
    })
    applyConfig(`#_単価_${i}_`, {
        textLength: 185,
        'text-anchor': 'end',
    })
    applyConfig(`#_金額_${i}_`, {
        textLength: 215,
        'text-anchor': 'end',
    })
}

for (const selector of ['#_小計_', '#_値引き_', '#_合計_', '#_消費税_', '#_税込合計_']) {
    applyConfig(selector, {
        textLength: 215,
        'text-anchor': 'end',
    })
}

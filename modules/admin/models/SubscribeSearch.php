<?php

namespace app\modules\admin\models;

use app\models\Subscribe;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Поиск и фильтрация подписчиков в админке.
 */
class SubscribeSearch extends Subscribe
{
    public function rules()
    {
        return [
            [['id', 'active'], 'integer'],
            [['email'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Subscribe::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 20],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'active' => $this->active,
        ]);
        $query->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}

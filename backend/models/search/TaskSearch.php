<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Task;

/**
 * TaskSearch represents the model behind the search form of `common\models\Task`.
 */
class TaskSearch extends Task
{
    public $authorName;
    public $statusName;
    public $projectName;
    public $priorityName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'status_id', 'priority_id', 'project_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description'], 'safe'],
            [['authorName', 'statusName', 'projectName', 'priorityName'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $projectId = null)
    {
        $query = Task::find();

        if (isset($projectId)) {
            $query->where(['project_id' => $projectId]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $this->author_id,
            'status_id' => $this->status_id,
            'priority_id' => $this->priority_id,
            'project_id' => $this->project_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['=', 'author_id', $this->authorName])
            ->andFilterWhere(['=', 'status_id', $this->statusName])
            ->andFilterWhere(['=', 'priority_id', $this->priorityName])
            ->andFilterWhere(['=', 'project_id', $this->projectName]);

        return $dataProvider;
    }
}

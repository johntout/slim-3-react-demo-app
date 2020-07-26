'use strict';

const e = React.createElement;

class Monsters extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			input: '',
			message: 'Loading...',
			results: null
		};

		this.inputChange = this.inputChange.bind(this);
	}

	inputChange(event) {
		this.setState({
			input: event.target.value,
		});
	}

	headersWithToken()
	{
		return {
			'Content-Type': 'application/json',
			'Authorization': 'Bearer '+localStorage.getItem('token')
		};
	}

	async componentDidMount()
	{
		const token = localStorage.getItem('token');

		if (token === null || token === 'undefined') {
			await fetch("/retrieve-token", {
				headers: {
					'Content-Type': 'application/json',
				},
			})
				.then(function(response) {
					return response.json();
				})
				.then(
					(result) => {
						localStorage.setItem('token', result);
					}
				)
				.catch(function(error) {
					console.log(error);
				});
		}

		const that = this;
		const promise = fetch("/api/monsters", { headers: that.headersWithToken() });

		promise
			.then(response => response.json())
			.then(function(response) {
				that.setState({
					results: that.renderMonsters(response),
					message: ''
				});
		});
	}

	async fetchMonsters() {
		this.setState({
			message: 'Loading...',
			results: null
		});

		const that = this;
		const level = that.state.input;
		const endpoint = level ? '/api/monsters/'+level : '/api/monsters';
		const promise = fetch(endpoint, {headers: that.headersWithToken()});

		promise
			.then(response => response.json())
			.then(function(response) {
				let message = '';
				let results = null;

				if (response.length == 0) {
					message = 'No results found!';
				}
				else {
					results = that.renderMonsters(response);
				}

				that.setState({
					message: message,
					results: results,
				});
			});
	}

	render() {
		return (
			<div>
				<div className="form-group">
					<label htmlFor="level">Level:
						<input className="form-control" type="text" value={this.state.input} onChange={this.inputChange} />
					</label>
				</div>
				<button className="btn btn-primary search-button" onClick={() => {this.fetchMonsters()}}>
					Search
				</button>
				<div>
					<div>{this.state.message}</div>

					<table className="table table-striped">
						<thead>
							<tr>
								<th>Edit</th>
								<th>ID</th>
								<th>Name</th>
								<th>Type</th>
								<th>Level</th>
								<th>Hit points</th>
								<th>P.Attack</th>
								<th>M. Attack</th>
								<th>P.Defense</th>
								<th>M.Defense</th>
								<th>Gold reward</th>
							</tr>
						</thead>
						<tbody>
							{this.state.results}
						</tbody>
					</table>
				</div>
			</div>
		)
	}

	renderMonsters(monsters) {
		return (
			monsters.map(item => (
				<tr key={item.id}>
					<td><a href={'/monsters/edit/' + item.id}>Edit</a></td>
					<td>{item.id}</td>
					<td>{item.name}</td>
					<td>{item.type}</td>
					<td>{item.level}</td>
					<td>{item.hp}</td>
					<td>{item.patk}</td>
					<td>{item.matk}</td>
					<td>{item.pdef}</td>
					<td>{item.mdef}</td>
					<td>{item.gold}</td>
				</tr>
			))
		);
	}
}

const searchForm = document.querySelector('#search-form');
ReactDOM.render(e(Monsters), searchForm);
